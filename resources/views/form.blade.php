<div>
    <Title>Test Form CSRF</Title>
    <form action="/form" method="post">
        <label for="name">
            <input type="text" name="name">
        </label>
        <input type="submit">
        @csrf
        <!-- Bisa pilih ingin menggunakan apa -->
        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}

    </form>
</div>
