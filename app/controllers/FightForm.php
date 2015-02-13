<?php

class FightForm {

	public static function sexSelect($name, $selected = "") {
		return Form::select($name, array('F' => 'Nő', 'M' => 'Férfi'), $selected);
	}

	public static function experienceSelect($name, $selected ="") {
		return Form::select($name, array('K' => 'Kezdő', 'H' => 'Haladó', 'M' => 'Mester'), $selected);
	}
}

?>