<?php
class AlertMessage{

public function alertMessage(){
	<echo '<script>
var r = confirm("La suppression est définitive. Confirmer ?");
if (r == true) {
    $confirm = true;
} else {
   $confirm = false;</script>';
}

}