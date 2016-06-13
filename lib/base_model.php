<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
          $validatorErrors = $this->{$validator}();
          $errors = array_merge($errors, $validatorErrors);
        
      }

      return $errors;
    }
    
    public function validate_string_length($string, $min, $max){
        $errors = array();
        if($string ==''||$string == null){
            $errors[] = 'Kenttä ei saa olla tyhjä';
        }
        if(strlen($string)<$min || strlen($string)>$max){
            $errors[] = 'Merkkijonon pituuden tulee olla välillä ' .$min.'-' .$max;
        }
        
        return $errors;
    }

  }
