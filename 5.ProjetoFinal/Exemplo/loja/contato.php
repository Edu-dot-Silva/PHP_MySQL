<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Contato - Livraria Online</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
   <?php include_once 'vendor/header.php';?>
  <main>
    <h2>Contato</h2>
    <div class="form-contato">
      <form>
        <label>Nome:</label>
        <input type="text" name="nome">
        <label>Email:</label>
        <input type="email" name="email">
        <label>Mensagem:</label>
        <textarea name="mensagem" rows="10"></textarea>
        <button type="submit">Enviar</button>
      </form>
      <div>
        <ul>
          <li>R. Tito, 54 - Vila Romana, São Paulo - SP, 05051-000</li>
          <li>11 99999-9999</li>
          <li>11 99999-8888</li>
          <li>contato@email.com</li>
        </ul>
      </div>
    </div>
    <div class="mapa">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7316.245565432984!2d-46.6917602!3d-23.528085899999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cef8775663b04f%3A0x923835e9005f8309!2sSenac%20Lapa%20Tito!5e0!3m2!1spt-BR!2sbr!4v1749751582818!5m2!1spt-BR!2sbr"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

  



  </main>
  <footer>
    <p>&copy; 2025 Livraria Online. Todos os direitos reservados.</p>
  </footer>
</body>

</html>