<?php
function sanitize($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
