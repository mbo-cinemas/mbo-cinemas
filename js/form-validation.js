document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input, textarea');
        const formId = form.id || 'form_' + Date.now();
        form.id = formId;

        // Herstel opgeslagen data
        const savedData = JSON.parse(localStorage.getItem(formId));
        if (savedData) {
            Object.keys(savedData).forEach(key => {
                const input = form.querySelector(`[name="${key}"]`);
                if (input) input.value = savedData[key];
            });
        }

        // Input validatie
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                validateField(this);
                saveFormState(form);
            });
        });

        // Submit validatie
        form.addEventListener('submit', function(e) {
            let isValid = true;
            inputs.forEach(input => {
                if (!validateField(input)) isValid = false;
            });

            if (!isValid) {
                e.preventDefault();
                showFeedback('Corrigeer de rode velden', 'error');
            } else {
                localStorage.removeItem(formId);
            }
        });
    });

    function validateField(field) {
        let isValid = true;
        const value = field.value.trim();

        // Basis required check
        if (field.required && !value) isValid = false;

        // Email validatie
        if (field.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
            isValid = false;
        }

        // Wachtwoord match
        if (field.name === 'confirm_password') {
            const password = field.form.querySelector('[name="password"]').value;
            if (value !== password) isValid = false;
        }

        // Visuele feedback
        field.style.borderColor = isValid ? '' : 'red';
        return isValid;
    }

    function saveFormState(form) {
        const data = {};
        form.querySelectorAll('input, textarea').forEach(input => {
            data[input.name] = input.value;
        });
        localStorage.setItem(form.id, JSON.stringify(data));
    }

    function showFeedback(message, type) {
        const div = document.createElement('div');
        div.className = `feedback ${type}`;
        div.textContent = message;
        document.body.appendChild(div);
        setTimeout(() => div.remove(), 3000);
    }
});