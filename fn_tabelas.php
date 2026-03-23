<?php

function fnCadastroTabAvaliador($link) {
	mysqli_query($link,"CREATE TABLE IF NOT EXISTS TabAvaliador (
        id int unsigned zerofill NOT NULL auto_increment,
		nome TEXT NOT NULL,
		siape TEXT NOT NULL,
		email TEXT NOT NULL,
		ife TEXT NOT NULL,
		senha TEXT NOT NULL,
		area TEXT NOT NULL,
		nivel TEXT NOT NULL,
		subarea TEXT,
		titulacao TEXT,
		telefone TEXT,
        PRIMARY KEY(id));"
	);
	return;	
}

function fnCadastroTabAcessoCPPDs($link) {
	mysqli_query($link,"CREATE TABLE IF NOT EXISTS TabAcessoCPPDs (
        id int unsigned zerofill NOT NULL auto_increment,
		docente TEXT NOT NULL,
		siapeCPPD TEXT NOT NULL,
		emailCPPD TEXT NOT NULL,
		ife TEXT NOT NULL,
		senha TEXT NOT NULL,
		telefone TEXT,
        PRIMARY KEY(id));"
	);
	return;
}

function fnAreaConhecimento($link) {
	mysqli_query($link,"CREATE TABLE IF NOT EXISTS TabAreaConhecimento (
        id int unsigned zerofill NOT NULL auto_increment,
		area TEXT NOT NULL,
        PRIMARY KEY(id));"
	);
	return;
}

function fnSubAreaConhec($link) {
	mysqli_query($link,"CREATE TABLE IF NOT EXISTS TabSubAreaConhec (
        id int unsigned zerofill NOT NULL auto_increment,
		subarea TEXT NOT NULL,
		area TEXT NOT NULL,
        PRIMARY KEY(id));"
	);
	return;
}
?>