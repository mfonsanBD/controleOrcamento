<?php
class esqueciController extends controller{
	public function index(){
		$this->titulo = "Esqueci minha senha";

		$this->loadTemplate('esqueci-minha-senha', $dados=array());
	}
	public function verificaEmail(){
		if(isset($_POST['email']) && !empty($_POST['email'])){
			$email = addslashes($_POST['email']);

			$u = new Usuario();

			if($u->verificaEmail($email)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	public function redefinirSenha(){
		if(isset($_POST['email']) && !empty($_POST['email'])){
			$email 		= addslashes($_POST['email']);
			$hash 		= md5(time().rand(0,9999));

			$ascii 		= implode('', array_merge(range('a', 'z'), range(0, 9)));
		    $ascii 		= str_repeat($ascii, 5);
		    $codigo 	= substr(str_shuffle($ascii), 0, 6);

			$u = new Usuario();
			$pegaNome = $u->getNome($email);
			$nome = $pegaNome['nome'];

			if($u->redefinirSenha($hash, $codigo, $email)){
				// require 'vendor/autoload.php';

				// $mail = new PHPMailer(true);

			 //    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
			 //    $mail->isSMTP();                                            // Set mailer to use SMTP
			 //    $mail->Host       = 'mail.buzios.digital';  				// Specify main and backup SMTP servers
			 //    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			 //    $mail->Username   = 'mike.santos@buzios.digital';           // SMTP username
			 //    $mail->Password   = 'Rick&Morty2017*/';                     // SMTP password
			 //    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
			 //    $mail->Port       = 465;                                    // TCP port to connect to

			 //    //Recipients
			 //    $mail->setFrom('mike.santos@buzios.digital', 'Equipe Controle de Orçamento.');
			 //    $mail->addAddress($email, $nome);     				  // Add a recipient

			 //    // Content
			 //    $mail->isHTML(true);                                  // Set email format to HTML
			 //    $mail->Subject = 'Confirmação de cadastro.';
			 //    $mail->Body    = "
				// 	<div style=width: 600px; line-height: 1.5; background-color: #f9f9f9; font-family: 'Helvetica', Geneva, sans-serif;>
				// 		<div style=width: 100%; background-color: #005E76; padding: 10px 0; text-align: center;>
				// 			<img src=".URL_BASE."assets/img/logo1.png width=120 alt=Logo Controle de Orçamentos>
				// 		</div>
				// 		<h2 style=text-align: center;>Redefinição de Senha</h2>
				// 		<p style=padding: 0 20px>
				// 			Prezado(a) <strong>".$nome."</strong>
				// 		</p>
				// 		<p style=padding: 0 20px>
				// 			Clique no botão abaixo e utilize o código a seguir para redefinir sua senha: <b>".$codigo."</b>
				// 		</p>
				// 		<p style=padding: 0 20px 30px>
				// 			<a style=background-color: #005E76; color: #FFFFFF; padding: 10px 20px; text-decoration: none; href=".URL_BASE."login/redefinicaoDeSenha/?hash=".$hash." target=_blank>
				// 				Redefinir
				// 			</a>
				// 		</p>
				// 		<p style=padding: 0 20px 30px>
				// 			Atenciosamente,<br>
				// 			Equipe Controle de Orçamento
				// 		</p>
				// 		<div style=width: 100%; font-size: 12px; background-color: #005E76; color: #FFFFFF; padding: 10px 0; text-align: center;>
				// 			&copy; ".date('Y')." - Controle de Orçamentos
				// 		</div>
				// 	</div>
			 //    ";
			 //    $mail->send();
			    echo "1";
			}else{
				echo "0";
			}
		}
	}
	public function verificaCodigo(){
		$hash 		= addslashes($_POST['hash']);
		$codigo 	= addslashes($_POST['codigo']);

		$u = new Usuario();

		if($u->verificaCodigo($hash, $codigo)){
			echo "1";
		}else{
			echo "0";
		}
	}
	public function redefinir(){
		if(isset($_POST) && !empty($_POST)){
			$senha 	= md5($_POST['senha']);
			$hash	= addslashes($_POST['hash']);

			$u = new Usuario();

			if($u->redefinir($senha, $hash)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	public function redefinicaoDeSenha(){
		$this->titulo = "Redefinição de Senha";
		$hash = addslashes($_GET['hash']);
		$dados['hash'] = $hash;
		$this->loadTemplate('redefinicao-de-senha', $dados);
	}
}