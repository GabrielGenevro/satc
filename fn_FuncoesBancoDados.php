<?php

function fnGetSubArea($link,$Area) {
	$query = "SELECT SubArea FROM TabSubAreaConhec WHERE Area = $Area";
	$result = mysqli_query($link, $query);
	return $res = mysqli_fetch_array($result);
}

function fnCadastraAreaConhecimento($link) {
	$query = "SELECT * FROM TabAreaConhecimento";
	$result = mysqli_query($link, $query);
	$numrows = mysqli_num_rows($result);
	if ($numrows == 0) {
		$query = "INSERT INTO TabAreaConhecimento (id,Area) VALUES (NULL,'Ciências Exatas e da Terra')";
		$result = mysqli_query($link, $query);

		$query = "INSERT INTO TabAreaConhecimento (id,Area) VALUES (NULL,'Ciências Biológicas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabAreaConhecimento (id,Area) VALUES (NULL,'Engenharias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabAreaConhecimento (id,Area) VALUES (NULL,'Ciências da Saúde')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabAreaConhecimento (id,Area) VALUES (NULL,'Ciências Agrárias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabAreaConhecimento (id,Area) VALUES (NULL,'Ciências Sociais Aplicadas')";
		$result = mysqli_query($link, $query);

		$query = "INSERT INTO TabAreaConhecimento (id,Area) VALUES (NULL,'Ciências Humanas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabAreaConhecimento (id,Area) VALUES (NULL,'Linguística, Letras e Artes')";
		$result = mysqli_query($link, $query);

		$query = "INSERT INTO TabAreaConhecimento (id,Area) VALUES (NULL,'Multidisciplinar')";
		$result = mysqli_query($link, $query);
	}
}

function fnCadastraSubAreaConhec($link) {
	$query = "SELECT * FROM TabSubAreaConhec";
	$result = mysqli_query($link, $query);
	$numrows = mysqli_num_rows($result);
	if ($numrows == 0) {
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Matemática','Ciências Exatas e da Terra')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Probabilidade e Estatística','Ciências Exatas e da Terra')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Ciência da Computação','Ciências Exatas e da Terra')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Astronomia','Ciências Exatas e da Terra')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Física','Ciências Exatas e da Terra')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Química','Ciências Exatas e da Terra')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Geociências','Ciências Exatas e da Terra')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Biologia Geral','Ciências Biológicas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Genética','Ciências Biológicas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Morfologia','Ciências Biológicas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Fisiologia','Ciências Biológicas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Bioquímica','Ciências Biológicas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Biofísica','Ciências Biológicas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Farmacologia','Ciências Biológicas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Imunologia','Ciências Biológicas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Microbiologia','Ciências Biológicas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Parasitologia','Ciências Biológicas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Ecologia','Ciências Biológicas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Oceanografia','Ciências Biológicas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Botânica','Ciências Biológicas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Zoologia','Ciências Biológicas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Engenharia Civil','Engenharias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Engenharia Sanitária','Engenharias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Engenharia de Transportes','Engenharias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Engenharia de Minas','Engenharias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Engenharia de Materiais e Metalúrgica','Engenharias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Engenharia Química','Engenharias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Engenharia Nuclear','Engenharias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Engenharia Mecânica','Engenharias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Engenharia de Produção','Engenharias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Engenharia Naval e Oceânica','Engenharias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Engenharia Aeroespacial','Engenharias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Engenharia Elétrica','Engenharias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Engenharia Biomédica','Engenharias')";
		$result = mysqli_query($link, $query);

		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Medicina','Ciências da Saúde')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Nutrição','Ciências da Saúde')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Odontologia','Ciências da Saúde')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Farmácia','Ciências da Saúde')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Enfermagem','Ciências da Saúde')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Saúde Coletiva','Ciências da Saúde')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Educação Física','Ciências da Saúde')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Fonoaudiologia','Ciências da Saúde')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Fisioterapia e Terapia Ocupacional','Ciências da Saúde')";
		$result = mysqli_query($link, $query);		
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Agronomia','Ciências Agrárias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Recursos Florestais e Engenharia Florestal','Ciências Agrárias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Engenharia Agrícola','Ciências Agrárias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Zootecnia','Ciências Agrárias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Recursos Pesqueiros e Egenharia de Pesca','Ciências Agrárias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Medicina Veterinária','Ciências Agrárias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Ciência e Tecnologia de Alimentos','Ciências Agrárias')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Direito','Ciências Sociais Aplicadas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Administração','Ciências Sociais Aplicadas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Turismo','Ciências Sociais Aplicadas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Economia','Ciências Sociais Aplicadas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Arquitetura e Urbanismo','Ciências Sociais Aplicadas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Desenho Industrial','Ciências Sociais Aplicadas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Planejamento Urbano e Regional','Ciências Sociais Aplicadas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Demografia','Ciências Sociais Aplicadas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Ciência da Informação','Ciências Sociais Aplicadas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Museologia','Ciências Sociais Aplicadas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Comunicação','Ciências Sociais Aplicadas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Serviço Social','Ciências Sociais Aplicadas')";
		$result = mysqli_query($link, $query);

		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Filosofia','Ciências Humanas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Teologia','Ciências Humanas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Sociologia','Ciências Humanas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Antropologia','Ciências Humanas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Arqueologia','Ciências Humanas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'História','Ciências Humanas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Geografia','Ciências Humanas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Psicologia','Ciências Humanas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Educação','Ciências Humanas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Ciência Política','Ciências Humanas')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Linguística','Linguística, Letras e Artes')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Letras','Linguística, Letras e Artes')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Artes','Linguística, Letras e Artes')";
		$result = mysqli_query($link, $query);

		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Interdisciplinar','Multidisciplinar')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Ensino','Multidisciplinar')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Materiais','Multidisciplinar')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Biotecnologia','Multidisciplinar')";
		$result = mysqli_query($link, $query);
		
		$query = "INSERT INTO TabSubAreaConhec (id,SubArea,Area) VALUES (NULL,'Ciências Ambientais','Multidisciplinar')";
		$result = mysqli_query($link, $query);
	}
}

?>