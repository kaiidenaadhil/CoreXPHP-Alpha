
<style>
.content.notFound {
  text-align: center;
  padding: 20px;
}

.content.notFound h1 {
  font-size: 48px;
  color: #333;
}

.content.notFound p {
  font-size: 24px;
  color: #666;
  margin-bottom: 20px;
  text-align: center;
}

.content.notFound a {
  display: inline-block;
  background-color: #333;
  color: #fff;
  padding: 10px 20px;
  text-decoration: none;
  border-radius: 4px;
  transition: background-color 0.3s;
}

.content.notFound a:hover {
  background-color: #555;
}

@media screen and (max-width: 768px) {
  .content.notFound {
    padding: 10px;
  }

  .content.notFound h1 {
    font-size: 36px;
  }

  .content.notFound p {
    font-size: 18px;
    margin-bottom: 10px;
    text-align: center;
  }

  .content.notFound a {
    font-size: 16px;
    padding: 8px 16px;
  }
}

  </style>
<section class="feed-container">
  <div class="feed">
    <div class="first-full">
      <span>404</span>
    </div>
  </div>
</section>
<div class="margin-top"></div>
  
  <div class="content notFound">
    <h1>404 Not Found</h1>
    <p>The page you are looking for does not exist.</p>
    <a href="<?=ROOT?>">Go back to the homepage</a>
  </div>

