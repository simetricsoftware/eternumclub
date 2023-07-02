<!DOCTYPE html>
<html>
<head>
	<title>Invitación a la fiesta egipcia</title>
</head>
<body>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td align="center" valign="top" style="background-color: #f5f5f5;">
				<table width="600" cellpadding="0" cellspacing="0" border="0">
					<!-- Image -->
					<tr>
						<td align="center" style="padding: 0 0 20px 0;">
							<h2>{{ $post->title }}</h2>
						</td>
					</tr>
					<!-- Cover -->
					<tr>
						<td align="center" style="padding: 0 0 20px 0;">
							<img src="{{ asset('storage/' . $post->image_url) }}" alt="Cover" width="600" style="max-width: 80%;" />
						</td>
					</tr>
					<!-- Message -->
					<tr>
						<td align="center" style="padding: 0 0 20px 0;">
							<p style="max-width: 50%; margin: 0 auto;">
								Gracias por tu compra, te adjuntamos los códigos QR para que puedas ingresar el día del evento. <br> Disfruta de la fiesta 🪩
							</p>
						</td>
					</tr>
					<!-- Footer -->
					<tr>
						<td align="center" style="padding: 20px 0 30px 0;">
							<img src="{{ asset('assets/images/eternumlogo.png') }}" alt="Eternum Club" width="100" style="display: block;" />
								<p style="color: #777; margin-top: 20px;">
                  Este evento fue patrocinado por Eternum Club, si deseas hacer tu evento y utilizar nuestro sistema de seguridad por QR, contactanos al correo <a href="mailto:info@simetricsoftwate.com">info@simetricsoftware.com</a>.
                  <br>
                  Eternum Club es un producto de <a href="https://simetricsoftware.com/">Simetric Software</a>.
								</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
