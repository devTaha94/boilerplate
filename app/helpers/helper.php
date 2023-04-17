<?php

/**
 * @param string $msg
 * @param array $data
 * @return void
 */
function success_response(string $msg = '', array $data = [])
{
    echo json_encode(['success' => true, 'msg' => $msg, 'data' => $data]);
    return;
}

/**
 * @param string $msg
 * @param array $errors
 * @return void
 */
function bad_response(string $msg = '', array $errors = [])
{
    echo json_encode(['success' => false, 'msg' => $msg]);
    return;
}
