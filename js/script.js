// Função para carregar o conteúdo com atraso de 3 segundos
function loadContent(page) {
    // Salva a página selecionada no localStorage
    localStorage.setItem('currentPage', page);
    
    // Mostra a mensagem de carregamento
    document.querySelector('.content').innerHTML = '<div class="loading">Processando... Por favor, aguarde.</div>';
    
    // Aguarda 3 segundos antes de exibir o conteúdo
    setTimeout(() => {
        // Carrega o conteúdo do PHP dinamicamente
        fetch('pages/' + page + '.php')
            .then(response => response.text())
            .then(data => {
                document.querySelector('.content').innerHTML = data;
            })
            .catch(error => console.error('Erro:', error));
    }, 3000);
}

// Função para carregar a página salva ao iniciar
function loadSavedPage() {
    const savedPage = localStorage.getItem('currentPage');
    if (savedPage) {
        loadContent(savedPage);
    } else {
        document.querySelector('.content').innerHTML = '<h2>Bem-vindo ao Sistema de Gestão de Veículos</h2><p>Escolha uma opção no menu para começar.</p>';
    }
}

// Carrega a página salva ao carregar a página
window.addEventListener('load', loadSavedPage);