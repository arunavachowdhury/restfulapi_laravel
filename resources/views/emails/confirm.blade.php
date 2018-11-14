Hellow {{$user->name}}
We need to verify the new email. Please using the link :
{{route('verify', $user->varification_token)}}