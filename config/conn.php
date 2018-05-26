<?php
\Cloudinary::config(array( 
	"cloud_name" => "ddyzyxi9w", 
	"api_key" => "193471554914476", 
	"api_secret" => "HVLI1igIGwdigVatAid51jCErMo" 
));
class Config extends PDO
{
	
	public function __construct()
		{
			parent::__construct('mysql:host=localhost;dbname=blog_db', 'root','');	
		}
}


?>