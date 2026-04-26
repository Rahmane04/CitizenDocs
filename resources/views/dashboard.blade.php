<?php
$role = auth()->user()->role;
if ($role === 'admin') {
    header('Location: /admin/dashboard');
} elseif ($role === 'agent') {
    header('Location: /agent/dashboard');
} else {
    header('Location: /citoyen/dashboard');
}
exit;
?>