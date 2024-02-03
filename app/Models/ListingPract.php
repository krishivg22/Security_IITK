<?php
namespace App\Models;   #for accessing this model from anywhere
                        #Model ye data waise database se lega, but here for understanding
class Listing{
    public static function all(){       #Model ka kaam hai database ko root se connect krna
        return [        
            [
            'id' => 1,
            'title' => 'Listing One',
            ],
    [
        'id' => 2,
        'title' => 'Listing two',
    ]
            ] ;
    }
    public static function find($id) {         # Particular listing access krne ke liye 
        $listings = self::all();
        foreach($listings as $listing) {
        if($listing ['id']== $id) {
        return $listing;
        }
        }
        }                                # So this is the model which we made manually , but we can make a model directly with php artisan which includes all diff functions like all,find etc .
} 

?>