<?php
$errors = [];

/**
 * get value from form input field
 * import after session start
 * @param mixed $inputName
 * @param bool $required
 * 
 * @return [String]
 */
function getInputValue($inputName, $required = true)
{
    global $errors;
    if (empty(trim($_REQUEST[$inputName]))) {
        if ($required) {
            array_push($errors, "$inputName is empty");
            $_SESSION["errors"] = $errors;
        }
        return null;
    }


    return htmlspecialchars($_REQUEST[$inputName]);
}