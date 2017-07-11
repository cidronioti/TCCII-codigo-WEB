$(function(){
	//VALIDANDO FORMULARIO DE CADASTRO DE LOTES
	$("especieErro").hide();
	$("linhagemErro").hide();
	$("tempConfErro").hide();
	$("faseConfErro").hide();
	$("quantidadeErro").hide();

	var erro_epecie = false;
	var erro_linhagem = false;
	var erro_tempoConf = false;
	var erro_faseConf = false;
	var erro_quantidade = false;

	$("#iEspecie").focusout(function(){
		check_especie();
	});
	$("#iLinhagem").focusout(function(){
		check_linhagem();
	});
	$("#iTempConf").focusout(function(){
		check_tempConf();
	});
	$("#iFaseConf").focusout(function(){
		check_faseConf();
	});
	$("#iQuantidade").focusout(function(){
		check_quantidade();
	});

	function check_especie(){
		var especie = document.getElementById('iEspecie').value;
		if(especie == ""){
			document.getElementById('especieErro').style.color="#ff0052";
			$("#especieErro").html("*Preencha o Campo");
			$("#especieErro").show();
			erro_epecie = true;
		}else{
			$("#especieErro").hide();
		}
	}

	function check_linhagem(){
		var linhgem = document.getElementById('iLinhagem').value;
		if(linhgem == ""){
			document.getElementById('linhagemErro').style.color="#ff0052";
			$("#linhagemErro").html("*Preencha o Campo");
			$("#lihagemErro").show();
			erro_epecie = true;
		}else{
			$("#linhagemErro").hide();
		}
	}	

	function check_tempConf(){
		var tempConf = document.getElementById('iTempConf').value;
		if(tempConf == ""){
			document.getElementById('tempConfErro').style.color="#ff0052";
			$("#tempConfErro").html("*Preencha o Campo");
			$("#tempConfErro").show();
			erro_tempoConf = true;
		}else{
			$("#tempConfErro").hide();
		}
	}


	function check_faseConf(){
		var faseConf = document.getElementById('iFaseConf').value;
		if(faseConf == ""){
			document.getElementById('faseConfErro').style.color="#ff0052";
			$("#faseConfErro").html("*Preencha o Campo");
			$("#faseConfErro").show();
			erro_faseConf = true;
		}else{
			$("#faseConfErro").hide();
		}
	}

	function check_quantidade(){
		var quantidade = document.getElementById('iQuantidade').value;
		if(quantidade == ""){
			document.getElementById('quantidadeErro').style.color="#ff0052";
			$("#quantidadeErro").html("*Preencha o Campo");
			$("#quantidadeErro").show();
			erro_quantidade = true;
		}else{
			$("#quantidadeErro").hide();
		}
	}

	$("#botao").click(function(){
		erro_epecie = false;
	    erro_linhagem = false;
	    erro_tempoConf = false;
	    erro_faseConf = false;
	    erro_quantidade = false;

		check_especie();
		check_linhagem();
		check_tempConf();
		check_faseConf();
		check_quantidade();
		
		if(erro_epecie == false && erro_linhagem == false && erro_tempoConf == false && erro_faseConf == false && erro_quantidade == false){
			return true;
		}else{
			return false;
		}

	});


	//VALIDANDO FORMULARIO ALTERA USUARIO

	$("idUsuarioErro").hide();
	$("nomeErro").hide();
	$("loginErro").hide();
	$("senhaErro").hide();
	$("confirmaSenhaErro").hide();

	var erro_id = false;
	var erro_nomeUsuario = false;
	var erro_login = false;
	var erro_senha = false;
	var erro_confirmaSenha = false;

	$("#idUsuario").focusout(function(){
		check_idUsuario();
	});
	$("#iNome").focusout(function(){
		check_nomeUsuario();
	});
	$("#iLogin").focusout(function(){
		check_login();
	});
	$("#iSenha").focusout(function(){
		check_senha();
	});
	$("#iConfirmaSenha").focusout(function(){
		check_confirmaSenha();
	});

	function check_idUsuario(){
		var id = document.getElementById('idUsuario').value;
		if(id == ""){
			document.getElementById('idUsuarioErro').style.color="#ff0052";
			$("#idUsuarioErro").html("*Preencha o Campo");
			$("#idUsuarioErro").show();
			erro_id = true;
		}else{
			$("#idUsuarioErro").hide();
		}
	}

	function check_nomeUsuario(){
		var nomeUsuario = document.getElementById('iNome').value;
		if(nomeUsuario == ""){
			document.getElementById('nomeErro').style.color="#ff0052";
			$("#nomeErro").html("*Preencha o Campo");
			$("#nomeErro").show();
			erro_nomeUsuario = true;
		}else{
			$("#nomeErro").hide();
		}
	}	

	function check_login(){
		var login = document.getElementById('iLogin').value;
		if(login == ""){
			document.getElementById('loginfErro').style.color="#ff0052";
			$("#loginErro").html("*Preencha o Campo");
			$("#loginErro").show();
			erro_login = true;
		}else{
			$("#loginErro").hide();
		}
	}

	function check_senha(){
		var senha = document.getElementById('iSenha').value;
		if(senha == ""){
			document.getElementById('senhaErro').style.color="#ff0052";
			$("#senhaErro").html("*Preencha o Campo");
			$("#senhaErro").show();
			erro_senha = true;
		}else{
			$("#senhaErro").hide();
		}
	}

	function check_confirmaSenha(){
		var confirmaSenha = document.getElementById('iConfirmaSenha').value;
		var compSenha = $("#iSenha").val();
		var compConfirmaSenha = $("#iConfirmaSenha").val();
		if(confirmaSenha == ""){
			document.getElementById('confirmaSenhaErro').style.color="#ff0052";
			$("#confirmaSenhaErro").html("*Preencha o Campo");
			$("#confirmaSenhaErro").show();
			erro_confirmaSenha = true;
		}else if(compSenha != compConfirmaSenha){
			document.getElementById('confirmaSenhaErro').style.color="#ff0052";
			$("#confirmaSenhaErro").html("*Senhas Diferentes Favor Repetir");
			$("#confirmaSenhaErro").show();
			erro_confirmaSenha = true;
		}else{
			$("#confirmaSenhaErro").hide();
		}
	}

	$("#fcontatosUsuario").submit(function(){
		erro_id = false;
		erro_nomeUsuario = false;
		erro_login = false;
		erro_senha = false;
		erro_confirmaSenha = false;
		
		check_idUsuario();
		check_nomeUsuario();
		check_login();
		check_senha();
		check_confirmaSenha();
		
		if(erro_id == false && erro_nomeUsuario == false && erro_login == false && erro_senha == false && erro_confirmaSenha == false){
			return true;
		}else{
			return false;
		}

	});
});