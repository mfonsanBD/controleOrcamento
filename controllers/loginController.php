<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class loginController extends controller{
	public function index(){
		$this->titulo = "Acesse sua conta ou faça seu cadastro.";
		$this->loadTemplate('login');
	}
	public function logar(){
		$usuario = new Usuario();
		if (isset($_POST['email']) && !empty($_POST['email'])) {
			$email = addslashes($_POST['email']);
			$senha = md5($_POST['senha']);

			if($usuario->verificaPermissao($email, $senha)){
				echo 2;
			}else{
				if($usuario->login($email, $senha)){
					echo 1;
				}else{
					echo 0;
				}
			}
		}
	}
	public function esqueci(){
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
	public function cadastro(){
		$usuario = new Usuario();
		if (isset($_POST) && !empty($_POST)) {
			$nome 		= addslashes($_POST['nome']);
			$sobrenome 	= addslashes($_POST['sobrenome']);
			$email 		= addslashes($_POST['email']);
			$senha 		= addslashes(md5($_POST['senha']));
			$codigo 	= md5(time().rand(0,9999));

			if ($usuario->cadastrar($nome, $sobrenome, $email, $senha, $codigo)) {
				require URL_BASE.'vendor/autoload.php';

				$mail = new PHPMailer(true);

				try {
				    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
				    $mail->isSMTP();                                            // Set mailer to use SMTP
				    $mail->Host       = 'mail.buzios.digital';  				// Specify main and backup SMTP servers
				    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
				    $mail->Username   = 'mike.santos@buzios.digital';           // SMTP username
				    $mail->Password   = 'Rick&Morty2017*/';                     // SMTP password
				    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
				    $mail->Port       = 465;                                    // TCP port to connect to

				    //Recipients
				    $mail->setFrom('mike.santos@buzios.digital', 'Equipe Controle de Orçamento.');
				    $mail->addAddress($email, $nome);     				  // Add a recipient

				    // Content
				    $mail->isHTML(true);                                  // Set email format to HTML
				    $mail->Subject = 'Confirmação de cadastro.';
				    $mail->Body    = "<div style=width: 600px; line-height: 1.5; background-color: #f9f9f9; font-family: 'Helvetica', Geneva, sans-serif;>
						<div style=width: 100%; background-color: #005E76; padding: 10px 0; text-align: center;>
							<img src=<?=URL_BASE?>assets/img/logo1.png width=120 alt=Logo Controle de Orçamentos>
						</div>
						<h2 style=text-align: center;>Confirmação de Cadastro</h2>
						<p style=padding: 0 20px>
							Olá $nome, tudo bem? Esperamos que sim.<br>
							Antes de mais nada, queremos agradecer por se cadastrar no <span style=color:#005E76;>Controle de Orçamento</span>! Aqui você pode gerenciar todos os leads que chegam até a sua empresa.
						</p>
						<p style=padding: 0 20px>
							Este e-mail é para confirmar que você fez o cadastro em nosso sistema.<br>
							É coisa rápida, só clicar no botão abaixo:
						</p>
						<p style=padding: 0 20px 30px>
							<a style=background-color: #005E76; color: #FFFFFF; padding: 10px 20px; text-decoration: none; href=".URL_BASE."confirma/confirmacao-de-cadastro/?codigo=$codigo>
								Confirmar
							</a>
						</p>
						<p style=padding: 0 20px 30px>
							Atenciosamente,<br>
							Equipe Controle de Orçamento
						</p>
						<div style=width: 100%; font-size: 12px; background-color: #005E76; color: #FFFFFF; padding: 10px 0; text-align: center;>
							&copy; 2019 - Controle de Orçamentos
						</div>
					</div>";

				    $mail->send();
				} catch (Exception $e) {
					?>
						<script>
							$(document).ready(function(){
				 	    		swal("Perdão!", "Ocorreu algum erro. Tente novamente mais tarde!", "erro");
				 	    	});
						</script>
					<?php
				}
			}else{
				?>
					<script>
						$(document).ready(function(){
			 	    		swal("Olá!", "Ocorreu algum erro. Por favor, entre em contato com o administrador.", "erro");
			 	    	});
					</script>
				<?php
			}
		}
	}
	public function sair(){
		unset($_SESSION['logado']);
		unset($_SESSION['nome_do_usuario']);
		unset($_SESSION['permissao']);
		unset($_SESSION['tipo']);
		header("Location: ".URL_BASE);
	}
}