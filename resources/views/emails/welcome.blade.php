Hellow {{$user->name}}
Please verify the email using the link :
{{route('verify', $user->varification_token)}}