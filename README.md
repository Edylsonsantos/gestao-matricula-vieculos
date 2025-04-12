# 🚗 Sistema de Gestão de Matrícula de Veículos

Este é um sistema web para registo, consulta e gestão de veículos e suas infrações. Ele foi desenvolvido em PHP e utiliza banco de dados MySQL para armazenar informações sobre os veículos e multas associadas.

O sistema permite o login, registo de veículos, processamento de informações e consulta de dados, com uma interface simples e acessível.

## 🔧 Funcionalidades

- Login de utilizador
- Registo de veículos
- Consulta de veículos e multas
- Processamento e visualização de dados
- Estilo moderno com CSS personalizado
- Scripts JS para interação do utilizador

## 📦 Tecnologias Utilizadas

- **Linguagem**: PHP
- **Banco de Dados**: MySQL (`vieculos.sql`)
- **Frontend**: HTML, CSS, JavaScript

## 📁 Estrutura do Projeto

```
matricula/
├── index.php                   # Página inicial
├── login.php                   # Tela de login
├── logout.php                  # Encerrar sessão
├── consultar_veiculos.php      # Consulta de veículos
├── processar_registro.php      # Lógica de inserção
├── mod/
│   └── consulta-multa.php      # Consulta de multas
├── vieculos.sql                # Script do banco de dados
├── css/
│   └── styles.css              # Estilo da aplicação
├── js/
│   └── script.js               # Script JS
```

## ▶️ Como Executar

1. Coloque o projeto dentro da pasta do seu servidor local (ex: `htdocs` no XAMPP).
2. Importe o ficheiro `vieculos.sql` no phpMyAdmin para criar a base de dados.
3. Verifique as credenciais de conexão com o banco de dados nos arquivos PHP.
4. Acesse `http://localhost/matricula` no navegador.

## 👨‍💻 Autor

**Edilson Luis Temporario Dos Santos**  
📞 Telefone/WhatsApp: +258 86 995 5418  
📧 E-mail: edylsondossantos02@gmail.com / edilsson.santos@labore.co.mz

## 📄 Licença

Este sistema é de livre uso para fins educacionais ou como base para aplicações comerciais. Sinta-se à vontade para modificar conforme necessário.
