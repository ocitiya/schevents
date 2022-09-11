<?php
if (!function_exists('generateURLParam')) {
  function generateURLParam ($url) {
    return true;
  }
}

if (!function_exists('inRole')) {
  function inRole ($roleList) {
    if (!in_array(session()->get("role"), $roleList)) {
      return false;
    } else {
      return true;
    }
  }
}