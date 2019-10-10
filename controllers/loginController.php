<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class loginController extends controller{
	public function index(){
		$usuario = new Usuario();
		if (isset($_POST['email']) && !empty($_POST['email'])) {
			$email = addslashes($_POST['email']);
			$senha = md5($_POST['senha']);

			$usuario->login($email, $senha);
		}
		$this->loadTemplate('login');
	}

	public function esqueci(){
		$this->loadTemplate('esqueci-minha-senha', $dados=array());
	}

	public function cadastro(){
		$usuario = new Usuario();
		if (isset($_POST) && !empty($_POST)) {
			$nome 		= addslashes($_POST['nome']);
			$email 		= addslashes($_POST['email']);
			$senha 		= addslashes(md5($_POST['senha']));
			$codigo 	= md5(time().rand(0,9999));

			if ($usuario->cadastrar($nome, $email, $senha, $codigo)) {
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
}