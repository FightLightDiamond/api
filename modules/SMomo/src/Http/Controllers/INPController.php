<?php


namespace SMOMO\Http\Controllers;


class INPController
{
    public function index() {
        logger(request()->all());
        return response(\request()->all());
    }
}
