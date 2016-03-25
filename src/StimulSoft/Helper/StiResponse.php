<?php

namespace StimulSoft\Helper;

class StiResponse {
    public static function json($result, $exit = true) {
        unset($result->object);
        echo json_encode($result);
        if ($exit) exit;
    }
}
