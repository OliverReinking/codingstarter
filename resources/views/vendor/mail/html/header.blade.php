<tr>
    <td class="header">
        @if (config('app.env') !== 'production')
            <div style="color:red; font-weight: bold, display: inline-block;">
                Achtung: Es handelt sich um eine Mail, die von unserem Testserver versendet wurde!
            </div>
        @endif

        <a href="{{ $url }}" style="display: inline-block;">
            {{ $slot }}
        </a>
    </td>
</tr>
