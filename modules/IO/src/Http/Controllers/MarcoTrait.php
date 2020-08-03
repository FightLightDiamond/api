<?php


namespace IO\Http\Controllers;

// thuộc tính __get __set
// function __call __callStatic
class MarcoTrait
{
    public $firstName = 'Quan';

    public $lastName = 'Tien';

    /**
     * We initialise our macros as an empty array that we will fill
     */
    public $macros = [];

    /**
     * We define this method to add new macro as we go
     * the first argument will be the name of the macro we want to define
     * the second will be a Closure function that will be executed when calling the macro
     */
    public function addMacro($name, $macro)
    {
        $this->macros[$name] = $macro;
    }

    /**
     * "__call" receives two parameters,
     * $name which will be the name of the function called in our case 'fullName'
     * $arguments which will be all the arguments passed in the function in our case it'll just be an empty array as we can't pass any arguments in our function
     */
    public function __call(string $name, array $arguments)
    {
//        dump($this->macros);
        if ($name === 'fullName') {
            $this->addMacro('fullName', function () {
                return $this->firstName . ' ' . $this->lastName;
            });
        }

//        dump($this->macros);

//        dump($name);
//        dd($arguments);
        /**
         * We retrieve the macro with the right name
         */
        $macro = $this->macros[$name];

//        dump($macro);
//
//        dump(static::class);
//        dump($this);
//        dd($macro->bindTo($this, static::class));
        /**
         * Then we execute the macro with the arguments
         * Note: we need to bind the Closure with "$this" before calling it to allow the macro method to act in the same context
         */
        return call_user_func_array($macro, $arguments);
        return call_user_func_array($macro->bindTo($this, static::class), $arguments);
    }
}
