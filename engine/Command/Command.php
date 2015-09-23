<?php

namespace IQU\Command;

interface Command {

    public function run(\IQU\DataSource\HttpRequest $request);
}