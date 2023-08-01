<?php
        echo "<script>";
        echo " Swal.fire({
            icon: 'error',
            title: '$title',
            text: '$text',
            showConfirmButton: false,
            timer: 2500
        }).then(() => {
            window.location.href = '$redirection';
        })";
        
        echo "</script>";
        ?>