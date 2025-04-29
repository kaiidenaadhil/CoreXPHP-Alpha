<?php include_once "./components/header.php"; ?>
<style>
 
</style>
<section class="container">
  <div class="tool-section">


    <div class="leftPortion">
      <div class="left-content">
        <h1 style="text-transform: uppercase;color: #767e87;">Build super fast apps with CoreXPHP,</h1>
        <h3 style="padding:0.5rem 0rem;color:#0859a6"> a powerful Core PHP MVC PDO framework for rapid, high-performance 
          development.</h3>
        <p style="  font-family: 'Courier New', monospace;">
          Just provide a JSON-formatted schema — our system will
           automatically generate the <b>Model</b>, <b>View</b>, <b>Controller</b>, <b>Database</b>,
            and <b>Router</b> for you.
        </p>
        <form action="data.php" method="POST">
          <input type="text" name="TABLE" value="product" class="inputText">
          <textarea name="JSON" class="textarea" rows="7"><?php
                                                          echo json_encode([
                                                            "productId" => "integer|primary_key|auto_increment",
                                                            "productName" => "string|max:100|unique",
                                                            "price" => "integer|min:1",
                                                            "stockQuantity" => "integer|min:0",
                                                            "productType" => "string|enum:physical,digital,service",
                                                            "status" => "string|enum:active,inactive",
                                                            "categoryId" => "integer|foreign:categories:categoryId",
                                                            "productImage" => "file:file:jpg,png|nullable"
                                                          ], JSON_PRETTY_PRINT);
                                                          ?></textarea>
          <button class="download-button">Try Now!</button>
          <a href="json-rules.php" class="myButton">JSON Rules List</a>
        </form>
      </div>
    </div>

    <div class="rightPortion">
      <!-- Your 3 codeblock divs go here (already responsive in structure) -->
      <div class="codeblock">
        <div class="codeblock-head">
          <div class="codeblock-header">
            <div class="browser"> <span></span> </div>
            <div class="browser-info">
              <h6 class="btn" data-clipboard-target="#codem">View</h6>
            </div>
          </div>
        </div>
        <div class="codeblock-body">
          <pre class="hljs language-json">
<code id="codem"  class="language-json">
{
  "name": "Dev Tool",
  "version": "1.0",
  "features": [
    "Schema Generator",
    "Live Preview",
    "JSON Viewer"
  ]
}
                                                 
</code>
        </pre>
        </div>
      </div>



      <div class="codeblock">
        <div class="codeblock-head">
          <div class="codeblock-header">
            <div class="browser"> <span></span> </div>
            <div class="browser-info">
              <h6 class="btn" data-clipboard-target="#codec">Model</h6>
            </div>
          </div>
        </div>
        <div class="codeblock-body">
          <pre class="hljs language-php">
<code id="codec"  class="language-php">

class productModel extends Model
{

	public function record($data = [])
	{
		$this->insert("product", $data);
	}

	public function countAll($search, $searchColumns)
	{
		return $this->searchCount("product", $search, $searchColumns);
	}

	public function displayAll($offset = null, $limit = null)
	{
           		$columns = array (
  0 => 'productId',
  1 => 'productName',
  2 => 'price',
  3 => 'stockQuantity',
  4 => 'productType',
  5 => 'status',
  6 => 'categoryId',
  7 => 'productImage',
  8 => 'productCreatedAt',
  9 => 'productIdentify',
  10 => 'productUpdated',
);
		return $this->paginate("product", $columns, [], $offset, $limit);
	}

	public function displayAllSearch($search, $searchColumns, $offset = null, $limit = null)
	{
	$columns = array (
  0 => 'productId',
  1 => 'productName',
  2 => 'price',
  3 => 'stockQuantity',
  4 => 'productType',
  5 => 'status',
  6 => 'categoryId',
  7 => 'productImage',
  8 => 'productCreatedAt',
  9 => 'productIdentify',
  10 => 'productUpdated',
);
		return $this->search("product", $columns, [], $search, $searchColumns, $offset, $limit);
	}

	public function displaySingle($id)
	{
		$columns = array (
  0 => 'productId',
  1 => 'productName',
  2 => 'price',
  3 => 'stockQuantity',
  4 => 'productType',
  5 => 'status',
  6 => 'categoryId',
  7 => 'productImage',
  8 => 'productCreatedAt',
  9 => 'productIdentify',
  10 => 'productUpdated',
);
		return $this->select("product", $columns, ["productIdentify" => $id]);
	}

	public function modify($data, $id)
	{
		return $this->updateWhere("product", $data, ["productIdentify" => $id]);
	}

	public function erase($id)
	{
		return $this->deleteWhere("product", ["productIdentify" => $id]);
	}
}

</code>
        </pre>

        </div>
      </div>


      <div class="codeblock">
        <div class="codeblock-head">
          <div class="codeblock-header">
            <div class="browser"> <span></span> </div>
            <div class="browser-info">
              <h6 class="btn" data-clipboard-target="#code">Controller</h6>
            </div>
          </div>
        </div>
        <div class="codeblock-body">
        <pre class="hljs language-php">
        <code id="codec"  class="language-php">
class productController extends Controller
{
    public function productIndex()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $productModel = $this->model('productModel');
        $searchColumns = array(
            0 => 'productId',
            1 => 'productName',
            2 => 'price',
            3 => 'stockQuantity',
            4 => 'productType',
            5 => 'status',
            6 => 'categoryId',
            7 => 'productImage',
            8 => 'productCreatedAt',
            9 => 'productIdentify',
            10 => 'productUpdated',
        );
        $totalRecords = $productModel->countAll($search, $searchColumns);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagination = new Pagination($totalRecords, $page, 10);
        $data = $productModel->displayAllSearch($search, $searchColumns, $pagination->getOffset(), $pagination->getLimit());
        $params['product'] = $data;
        if ($totalRecords > $pagination->getLimit()) {
            $params['pagination'] =  $pagination->render();
        } else {
            $params['pagination'] = '';
        }
        $this->adminView('product/productAll', $params);
    }

    public function productDisplay(Request $request, $productIdentify)
    {
        $productModel = $this->model('productModel');
        $params['product'] =  $productModel->displaySingle($productIdentify);
        $this->adminView('product/productSingle', $params);
    }

    public function productDestroy(Request $request, $productIdentify)
    {
        $productModel = $this->model('productModel');
        $productModel->erase($productIdentify);
        // success delete and redirect
        header("Location:  " . ROOT . "/admin/product/");
        $_SESSION['success_message'] = "Delete successful!";
        exit;
    }

    public function productbuild()
    {
        $this->adminView('product/productNew');
    }

    public function productRecord(Request $request)
    {
        $productModel = $this->model('productModel');
        $data = $request->getBody();
        $data['productUpdated'] = date('Y-m-d H:i:s');
        $data['productIdentify'] = generateUniqueId(16);
        $rules = array(
            'productName' => 'required|max:100',
            'price' => 'required|min:1',
            'stockQuantity' => 'required|min:0',
            'productType' => 'required',
            'status' => 'required',
            'categoryId' => 'required',
            'productImage' => 'required',
            'productCreatedAt' => '',
            'productIdentify' => 'required',
            'productUpdated' => '',
        );
        $validator = new Validator();
        $validator->validate($rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors as $error) {
                echo $error . "</br>";
            }
        } else {
            $productModel->record($data);
            // success adding and redirect
            header("Location:  " . ROOT . "/admin/product/");
            $_SESSION['success_message'] = "Added successful!";
            exit;
        }
    }

    public function productModify(Request $request, $productIdentify)
    {
        $productModel = $this->model('productModel');
        $params['productIdentify'] = $productIdentify;
        $params['product'] =  $productModel->displaySingle($productIdentify);
        $this->adminView('product/productEdit', $params);
    }

    public function productEdit(Request $request, $productIdentify)
    {
        $productModel = $this->model('productModel');
        $data = $request->getBody();
        $rules = array(
            'productName' => 'required|max:100',
            'price' => 'required|min:1',
            'stockQuantity' => 'required|min:0',
            'productType' => 'required',
            'status' => 'required',
            'categoryId' => 'required',
            'productImage' => 'required',
            'productCreatedAt' => '',
            'productIdentify' => 'required',
            'productUpdated' => '',
        );
        $validator = new Validator();

        if ($validator->fails($rules)) {
            $errors = $validator->errors();
            foreach ($errors as $error) {
                echo $error . "</br>";
            }
        } else {
            $productModel->modify($data, $productIdentify);
            // success updated and redirect
            header("Location:  " . ROOT . "/admin/product/");
            $_SESSION['success_message'] = "Update successful!";
            exit;
        }
    }
}


          </code>
        </pre>

        </div>
      </div>



      <!-- Keep the <div class="codeblock"> elements as-is -->
    </div>
  </div>
</section>


<style>
.tool-section {
  display: flex;
  flex-wrap: wrap; /* allow stacking */
  margin-bottom: 3rem;
  min-height: 520px;
  width: 100%;
  box-sizing: border-box;
}


.leftPortion,
.rightPortion {
  width: 100%;
  padding: 1rem 0rem;
  box-sizing: border-box;
}

.left-content {
  margin-right: 4rem;
}

.left-content h1 {
  font-size: 2rem;
  font-weight: 800;
  line-height: 2.7rem;
}

.left-content p {
  font-size: 1rem;
  font-weight: 300;
  line-height: 1.5rem;
  text-align: justify;
  margin-bottom: 1.5rem;
}
input[type="text"], select {
  width: 100%;
	  border: 1px solid #cbd5e1;
    transition: all 0.2s ease;
    padding: 0.5rem;
    border-radius: 1.5rem;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 14px;
}
.inputText {
  width: 100%;
  margin-bottom: 1rem;
  padding: 1rem;
  font-size: 1rem;
  border-radius: 1.5rem;
  border: 1px solid #ccc;
  background: #343f50;
  color: white;
}

  .leftPortion,
  .rightPortion {
    width: 50%;
  }
.rightPortion{
  margin-left: 2rem;
   width:calc(48% - 1rem);
}
  .left-content {
    margin-right: 4rem;
    padding:1rem;
  }



  @media (max-width: 768px) {
    .leftPortion,
  .rightPortion {
    width: 100%;
  }
  .left-content {
    margin-right: 0rem;
    padding:1rem;
  }


  .rightPortion{
    margin-left: 2rem; 
    width: calc(97% - 1rem);
    position: relative;
    clear: both;
    height: 68vh;
    margin-left: 2rem;
  }
}
</style>



<section class="download-section">
  <div class="download-container">
    <h1 class="download-heading">
    Would you like to download CoreXPHP framework?
    </h1>
    <button class="download-button">Download Now!</button>
  </div>
</section>
<style>
  .download-section {
  width: 100%;
  background-color: white;
  background-image: url('assets/actionbg.png');
  background-size: cover;
  background-position: center;
  display: block;
  clear: both;
}

.download-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem 1rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem;
  flex-wrap: wrap;
}

.download-heading {
  color: white;
  font-size: 1.8rem;
  font-weight: 800;
  flex: 1 1 70%;
}

/* Button Style */
.download-button {
  background-color: #10b981;
  color: white;
  border: none;
  padding: 0.8rem 1.5rem;
  font-size: 1rem;
  font-weight: 600;
  border-radius: 0.5rem;
  cursor: pointer;
  transition: background 0.3s;
}

.download-button:hover {
  background-color: #059669;
}

/* === Responsive Styling === */
@media (max-width: 768px) {
  .download-container {
    flex-direction: column;
    text-align: center;
  }

  .download-heading {
    font-size: 1.5rem;
    flex: 1 1 100%;
  }

  .download-button {
    width: 100%;
    flex: 1 1 100%;
  }
}
</style>
<style>
  #formTitle {
    position: relative;
    text-align: center;
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 700;
    margin: 60px auto 30px;
    padding: 20px 10px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(to right, #0f62fe, #00c6ff);
    -webkit-text-fill-color: transparent;
    animation: fadeInUp 0.7s ease-out;
    letter-spacing: 1px;
  }

  #formTitle::before,
  #formTitle::after {
    content: '';
    position: absolute;
    height: 3px;
    width: 60px;
    background: #0f62fe;
    top: 50%;
    transform: translateY(-50%);
  }

  #formTitle::before {
    left: -80px;
  }

  #formTitle::after {
    right: -80px;
  }

  @media (max-width: 600px) {
    #formTitle::before,
    #formTitle::after {
      width: 40px;
      left: -50px;
      right: -50px;
    }
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>

<section>
  <div class="container">
    <h1 style="text-align:center;"><br> Model Schema Creation form</h1>
    <?php require_once 'form.php'; ?>
  </div>


  
  <div class="container">
    <h1 style="text-align:center;">Model Schema List</h1>
    <?php require_once 'list.php'; ?>
  </div>

<style>


.container table {
  width: 100%;
  border-collapse: collapse;
  background: white;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.container th,
.container td {
  text-align: left;
  border-bottom: 1px solid #e2e8f0;
}

.container th {
  background-color: #f8fafc;
  font-weight: 800;
}

.container pre {
  margin: 0;
  overflow-x: auto;
}



/* Mobile Responsive Styles */
@media (max-width: 767px) {
  .container {
    padding: 0;
  }

  .container table,
  .container thead,
  .container tbody,
  .container th,
  .container td,
  .container tr {
    display: block;
  }

  .container thead tr {
    position: absolute;
    top: -9999px;
    left: -9999px;
  }

  .container tr {
    margin-bottom: 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
  }

  .container td {
    border: none;
    position: relative;
    padding-left: 50%;
  }

  .container td:before {
    position: absolute;
    left: 1rem;
    width: 45%;
    padding-right: 1rem;
    white-space: nowrap;
    font-weight: 600;
    content: attr(data-label);
  }

  .container pre {
    font-size: 12px;
    padding: 0.5rem;
  }



  /* Add data-label attributes through JavaScript or directly in HTML */
  /* .container td:nth-of-type(1):before { content: "Model:"; }
  .container td:nth-of-type(2):before { content: "Code:"; }
  .container td:nth-of-type(3):before { content: "Destroy:"; }
  .container td:nth-of-type(4):before { content: "Modify:"; } */
}
</style>
  
</section>

<script>
  document.querySelectorAll('.container td').forEach(td => {
  const index = Array.from(td.parentNode.children).indexOf(td) + 1;
  td.setAttribute('data-label', ['Model', 'Code', 'Destroy', 'Modify'][index-1]);
});

  $(document).ready(function() {
    $('.modify').click(function() {
      var targetId = $(this).data('target');
      var jsonCode = $('#' + targetId).text().trim();
      alert(jsonCode);
    });
  });
</script>


<section class="cta-highlight">
  <div class="container cta-flex">
    <div class="cta-content">
      <h2 class="cta-title">Instantly generate MVC structure for your PHP app.</h2>

      <hr class="cta-divider">
      <p class="cta-description">
        CodeXBuilder automates your workflow — create models, views, controllers, databases, and routes with one JSON schema.
        Build production-ready apps faster, without writing boilerplate.
      </p>
      <button class="download-button">Start now!</button>
    </div>
  </div>
</section>

<style>
  .cta-highlight {
    background-color: #e9e9e9;
    padding: 3rem 1rem;
  }

  .cta-flex {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
  }

  .cta-content {
    width: 100%;
    max-width: 900px;
    text-align: center;
  }

  .cta-title {
    font-size: 2rem;
    font-weight: 800;
    line-height: 2.7rem;
    text-transform: uppercase;
    margin-bottom: 1rem;
  }

  .cta-divider {
    margin: 1rem auto;
    border: none;
    height: 1px;
    background-color: #ccc;
    width: 60%;
  }

  .cta-description {
    font-size: 1.1rem;
    line-height: 1.8rem;
    font-weight: 300;
    margin-bottom: 2rem;
    color: #333;
    text-align: justify;
  }


  @media (max-width: 768px) {
    .cta-title {
      font-size: 1.5rem;
      line-height: 2.2rem;
    }

    .cta-description {
      font-size: 1rem;
      line-height: 1.6rem;
    }

    .cta-divider {
      width: 80%;
    }
  }
</style>
<section class="builder-hero-section">
  <div class="container builder-hero-content">
    <h2 class="builder-title">
      Code smarter, not harder — with CodeXBuilder.
    </h2>

    <p class="builder-description">
      CodeXBuilder is designed to help developers rapidly prototype and deploy high-performance PHP MVC apps — all from your browser. Focus on your logic while we generate the boilerplate.
    </p>

    <div class="builder-image-wrapper">
      <img src="assets/img/balancing.svg" alt="Efficiency Graphic" class="builder-image">
    </div>

    <h3 class="builder-subtitle">
      Build faster. Stay focused. Ship smarter.
    </h3>
  </div>
</section>

<style>
  .builder-hero-section {
    background-color: #3b3b3c;
    background-image: url("https://trongate.io/themes/dark_neon/default/images/trondark.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    padding: 3rem 1rem;
    color: white;
  }

  .builder-hero-content {
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
  }

  .builder-title {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 1rem;
  }

  .builder-description {
    font-size: 1.1rem;
    font-weight: 300;
    line-height: 1.6rem;
    margin-bottom: 2rem;
  }

  .builder-image-wrapper {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
  }

  .builder-image {
    width: 100%;
    max-width: 600px;
    height: auto;
  }

  .builder-subtitle {
    margin-top: 2rem;
    font-size: 1.5rem;
    font-weight: 600;
  }

  /* Responsive tweaks */
  @media (max-width: 768px) {
    .builder-title {
      font-size: 1.6rem;
    }

    .builder-subtitle {
      font-size: 1.2rem;
    }

    .builder-description {
      font-size: 1rem;
    }
  }
</style>

<section>
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>This is a beautiful model dialog!</p>
    </div>
  </div>

</section>

<?php include_once "./components/footer.php"; ?>