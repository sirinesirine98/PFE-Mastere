<!DOCTYPE html>
<html>

<head>
    <title>{{ $subject }}</title>
</head>

<body>


    <div style="font-family: Arial, sans-serif; padding: 20px; background-color: #f5f5f5;">
        <div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 10px; padding: 20px;">
            <h1 style="text-align: center; color: #3d3d3d; margin-bottom: 40px;">Bienvenue dans Notre site de
                téléconsultation médicale</h1>
            <p style="font-size: 18px ;color: #574cd4;">Votre code d'accés à la téléconsultation est </p>
            <p style="font-size: 25px; color: #010101;text-align: center">{{ $roomId }}</p>
            <p style="font-size: 20px ;color: #3d3d3d;">Vous aller consulter notre site <a
                    href=`http://localhost:3000>ici</a>
                {{-- <strong>${role}</strong>.</p> --}}
            <p style="font-size: 18px; color: #3d3d3d;">Cet e-mail vous a éte envoyé parce que nous avons accepté votre
                Rendez-vous et vous pouvez joindre la téléconsultation facilement

            </p>
            {{-- <p style="font-size: 18px; color: #3d3d3d;">Here is your password: <strong>{{password}}</strong></p> --}}

            <p style="font-size: 16px; color: #666; margin-top: 40px;">Cordialement,<br>l'équipe de Compixia</p>
        </div>
    </div>
</body>

</html>
