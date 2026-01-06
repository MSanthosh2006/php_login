<?php
session_start();
session_destroy();
echo "<script>alert('Session is Destroyed');location.href='index.html';</script>"; 
?>