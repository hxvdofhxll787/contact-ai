<h2>Новое письмо</h2>

<p><b>Имя:</b> {{ $contact->name }}</p>

<p><b>Email:</b> {{ $contact->email }}</p>

<p><b>Номер телефона:</b> {{ $contact->phone }}</p>

<p><b>Текст сообщения:</b></p>

<p>{{ $contact->comment }}</p>

<hr>

<p>
    <b>Настроение сообщения:</b>
    {{ $contact->sentiment }}
</p>

<p>
    <b>Категория сообщения:</b>
    {{ $contact->category }}
</p>
