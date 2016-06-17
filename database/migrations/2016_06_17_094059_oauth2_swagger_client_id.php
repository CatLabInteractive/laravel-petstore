<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Oauth2SwaggerClientId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the "full" grant
        DB::table('oauth_scopes')->insert([
            'id' => 'full',
            'description' => 'Full access to the API',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        
        // Create the swagger oauth application
        $url = url('vendor/swagger-ui/dist/o2c.html');
        $clientId = Config::get('oauth2.swagger-ui.client_id');

        DB::table('oauth_clients')->insert([
            'id' => $clientId,
            'secret' => base64_encode(random_bytes(32)),
            'name' => 'Swagger documentation',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('oauth_client_endpoints')->insert([
            'client_id' => $clientId,
            'redirect_uri' => $url,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $url = url('vendor/swagger-ui/dist/o2c.html');
        $clientId = Config::get('oauth2.swagger-ui.client_id');

        DB::table('oauth_scopes')->delete([ 'id' => 'full' ]);
        DB::table('oauth_clients')->delete([ 'id' => $clientId ]);
        DB::table('oauth_client_endpoints')->delete([
            'client_id' => $clientId,
            'redirect_uri' => $url
        ]);
    }
}
