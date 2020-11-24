<?php

function inputValidation($id,$name,$contact,$email,$dob){
    $idValidation='/^[a-zA-Z0-9]+$/';
    $nameValidation='/^[a-zA-Z\s]+$/';
    $contactValidation='/^[0-9]{8}$/';
    $emailValidation='/^[a-zA-Z0-9._%+-]{1,64}@(?:[a-zA-Z0-9-]{1,63}\.){1,125}[a-zA-Z]{1,63}$/';
    $dateValidation='/^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[012])-\d\d\d\d$/';

    if(preg_match($idValidation,$id)){
        if(preg_match($nameValidation,$name)){
            if(preg_match($contactValidation,$contact)){
                if(preg_match($emailValidation,$email)){
                    if(preg_match($dateValidation,$dob)){
                        echo 'Input Validation is a success<br>';
                        return true;
                    }
                    else{
                        echo 'Invalid date, please try again<br>';
                    }
                }
                else{
                    echo 'Invalid email, please try again<br>';
                }
            }
            else{
                echo 'Invalid contact, please try again<br>';
            }
        }
        else{
            echo 'Invalid name, please try again<br>';
        }
    }
    else{
        echo 'Invalid id, please try again<br>';
    }
}

function deleteValidation($id){
    $idValidation='/^[a-zA-Z0-9]+$/';
    if(preg_match($idValidation,$id)){
        echo 'Validation is a success<br>';
        return true;
    }
    else{
        echo 'Invalid Id, please try again<br>';
    }
}
?>