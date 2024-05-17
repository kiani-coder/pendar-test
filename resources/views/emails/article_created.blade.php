@component('mail::message')
# Hello Admin,

A new article has been created with the title: {{ $article->title }}

@component('mail::button', ['url' => url('/articles/' . $article->id)])
View Article
@endcomponent

Thank you for using our application!

@endcomponent
