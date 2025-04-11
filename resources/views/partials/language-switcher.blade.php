<div class="language-switcher">
    <select onchange="changeLanguage(this)">
        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>GB English</option>
        <option value="pt" {{ app()->getLocale() == 'pt' ? 'selected' : '' }}>PT Português</option>
        <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>FR Français</option>
    </select>
</div>

<script>
    function changeLanguage(select) {
        const lang = select.value;
        window.location.href = `/lang/${lang}`;
    }
</script>
