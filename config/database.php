<?php 

function getDatabaseConfig(): array
{
    return [
        "database" => [
            "test" => [
                "url" => "mysql:host=localhost:3306;dbname=teleblastv1.0.0_test",
                "username" => "root",
                "password" => ""
            ],
            "prod" => [
                "url" => "mysql:host=localhost:3306;dbname=teleblastv1.0.0",
                "username" => "root",
                "password" => ""
            ]
        ]
    ];
}