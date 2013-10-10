<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/

	"accepted"         => "Ce champ doit être accepté.",
	"active_url"       => "Ce n'est pas une URL valide.",
	"after"            => "La date ne doit pas dépasser :date.",
	"alpha"            => "Le champ ne peut contenir que des lettres.",
	"alpha_dash"       => "Le champ ne peut contenir que des lettres, chiffres et tirets.",
	"alpha_num"        => "Le champ ne peut contenir que des lettres et chiffres.",
	"before"           => "La doite ne doit pas précéder :date.",
	"between"          => array(
		"numeric" => "Le champ doit être entre :min - :max.",
		"file"    => "Le fichier doit être compris entre :min - :max ko.",
		"string"  => "Le champ doit être compris entre :min - :max caractères.",
	),
	"confirmed"        => "Le champs de confirmation ne correspondent pas.",
	"date"             => "Le champ n'est pas une date valide.",
	"date_format"      => "Le champ doit être au format :format.",
	"different"        => "Les champs indiqués doivent être différents.",
	"digits"           => "Le champ doit faire :digits caractères.",
	"digits_between"   => "Le champ doit être compris entre :min et :max caractères.",
	"email"            => "Le champ doit être un email valide.",
	"exists"           => "Le champ doit être valide.",
	"image"            => "Le champ doit être de type image.",
	"in"               => "Le champ sélectionné est invalide.",
	"integer"          => "Le champ doit être un entier.",
	"ip"               => "Le champ doit être une adresse IP valide",
	"max"              => array(
		"numeric" => "Le champ ne doit pas dépasser :max. caractères",
		"file"    => "Le fichier ne doit pas dépasser :max caractères.",
		"string"  => "Ce champ ne doit pas dépasser :max caractères.",
	),
	"mimes"            => "Le champ doit être au format : :values.",
	"min"              => array(
		"numeric" => "Ce champ doit faire au minimum :min caractères",
		"file"    => "Ce fichier doit faire au moins :min ko.",
		"string"  => "Ce champ doit faire au minimum :min caractères",
	),
	"not_in"           => "Le champ sélectionné n'est pas valide.",
	"numeric"          => "Le champ doit être un nombre.",
	"regex"            => "Le format du champ n'est pas valide.",
	"required"         => "Ce champ est obligatoire.",
	"same"             => "Les champs doivent correspondre",
	"size"             => array(
		"numeric" => "Le champ doit faire :size.",
		"file"    => "Le champ doit faire :size ko.",
		"string"  => "Le champ doit faire :size caractères.",
	),
	"unique"           => "Le champ doit être unique.",
	"url"              => "Le champ n'est pas une URL valide",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
