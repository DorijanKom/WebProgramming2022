<?php
class Config{

    public static function DB_HOST(){
        return Config::getEnv("DB_HOST", "127.0.0.1");
    }

    public static function DB_USERNAME(){
        return Config::getEnv("DB_USERNAME", "root");
    }

    public static function DB_PASSWORD(){
        return Config::getEnv("DB_PASSWORD", "4@ERbR2gSa6yLg");
    }

    public static function DB_SCHEME(){
        return Config::getEnv("DB_SCHEME", "Bookstore");
    }

    public static function DB_PORT(){
        return Config::getEnv("DB_PORT", "3306");
    }

    public static function JWT_SECRET(){
        return Config::getEnv("JWT_SECRET", "JZ%@@qVNCmm2XB");
    }

    public static function getEnv($name,$default){
        return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
    }
}
?>