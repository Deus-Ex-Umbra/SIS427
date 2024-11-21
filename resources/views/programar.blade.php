<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Virtual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.14/ace.js" integrity="sha512-ptzxNfrVjTmduPzJ1dZLftI4LTXuwwqH5eEpeZl3fKOKzWk9ZXFeXbaB9H5Eh1Cq3PnVv2FDZ3cqkk9sqJceog==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div class="d-flex">

        <div class="flex-grow-1">
            <header class="bg-primary text-white py-3 px-4">
                <h1 class="m-0">Campus Virtual</h1>
            </header>

            <!-- Cursos y Editor de Código -->
            <main class="p-4">
                <h2 class="mt-5 mb-4">Ejecutar Código</h2>
                <form action="{{ route('user.execute') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="language" class="form-label">Lenguaje</label>
                        <select name="language" id="language" class="form-select">
                            <option value="c">C</option>
                            <option value="cpp">C++</option>
                            <option value="java">Java</option>
                            <option value="python3">Python</option>
                            <option value="php">PHP</option>
                            <option value="csharp">C#</option>
                            <option value="nodejs">JavaScript</option>
                            <option value="assembly">Assembler</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Código</label>
                        <textarea name="code" id="code" class="form-control" rows="30">//Escribe Aquí:</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="stdin" class="form-label">Entrada Estándar (opcional)</label>
                        <textarea name="stdin" id="stdin" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Ejecutar</button>
                </form>
            </main>
        </div>
    </div>
    <script>
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        var languageSelect = document.getElementById('language');
        var languageModes = {
            c: 'c_cpp',
            cpp: 'c_cpp',
            java: 'java',
            python3: 'python',
            php: 'php',
            csharp: 'csharp',
            nodejs: 'javascript',
            assembly: 'assembly_x86'
        };
        function setEditorMode() {
            var language = languageSelect.value;
            var mode = languageModes[language] || 'text';
            editor.session.setMode("ace/mode/" + mode);
        }
        languageSelect.addEventListener('change', setEditorMode);
        setEditorMode();
        var form = document.querySelector('form');
        form.addEventListener('submit', function() {
            document.getElementById('code').value = editor.getValue();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
