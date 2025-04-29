<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JSON Schema Rules for Database Table Creation</title>
    
    <!-- Link to Highlight.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/default.min.css">
    
    <style>
        /* General body and page styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1, h2 {
            text-align: center;
            color: #2c3e50;
            padding-top: 20px;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Styling for the code blocks */
        pre {
            background-color: #2d2d2d;
            color: #f8f8f2;
            padding: 20px;
            border-radius: 10px;
            overflow-x: auto;
            font-size: 1rem;
        }

        code {
            font-family: 'Courier New', Courier, monospace;
        }

        .rule-list {
            padding-left: 20px;
        }

        .rule-list li {
            padding: 8px 0;
        }

        .json-example {
            font-size: 1.1rem;
            font-family: 'Courier New', Courier, monospace;
            padding: 10px;
        }

        /* Styling for explanations */
        .explanation {
            background-color: #ecf0f1;
            padding: 10px;
            border-radius: 8px;
            margin: 10px 0;
        }

        /* Mobile responsiveness */
        @media screen and (max-width: 768px) {
            h1 {
                font-size: 1.5rem;
            }

            .container {
                padding: 10px;
            }

            pre {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>JSON Schema Rules for Database Table Creation</h1>
    
    <h2>Examples of Column Types and Constraints</h2>
    <p>Below are the various rules for defining columns in a database schema in JSON format:</p>

    <!-- JSON Code Example with Highlight.js -->
    <pre><code class="json">
{
    "productId": "integer|primary_key|auto_increment",
    "productName": "string|max:100|unique",
    "price": "integer|min:1",
    "stockQuantity": "integer|min:0|unsigned",
    "productType": "string|enum:physical,digital,service",
    "status": "string|enum:active,inactive|default:active",
    "categoryId": "integer|foreign:categories:categoryId",
    "productImage": "string|nullable",
    "createdAt": "timestamp|nullable|default:CURRENT_TIMESTAMP",
    "updatedAt": "timestamp|nullable|on_update"
}
    </code></pre>

    <h2>Explanation of Rules</h2>
    <ul class="rule-list">
        <li><strong>integer</strong>: Defines a column as an integer type (e.g., <code>productId</code>).</li>
        <li><strong>string|max:<number></strong>: Defines a column as a string with a maximum length (e.g., <code>productName</code>).</li>
        <li><strong>text</strong>: Defines a column as a text type, used for long strings (e.g., <code>description</code>).</li>
        <li><strong>timestamp</strong>: Defines a column as a timestamp (e.g., <code>createdAt</code>).</li>
        <li><strong>enum:</strong> Defines a column as an enum with a set of possible values (e.g., <code>status</code> with values <code>active,inactive</code>).</li>
    </ul>

    <h2>How to Form JSON for Each Type</h2>
    <p>Here are some examples for forming each type of column in the JSON schema:</p>

    <div class="explanation">
        <h3>Basic Column Definition:</h3>
        <pre class="json-example">"id": "integer"</pre>
    </div>

    <div class="explanation">
        <h3>Primary Key Column:</h3>
        <pre class="json-example">"id": "integer|primary_key|auto_increment"</pre>
    </div>

    <div class="explanation">
        <h3>String Column with Maximum Length:</h3>
        <pre class="json-example">"name": "string|max:100"</pre>
    </div>

    <div class="explanation">
        <h3>Text Column:</h3>
        <pre class="json-example">"description": "text"</pre>
    </div>

    <div class="explanation">
        <h3>Enum Column:</h3>
        <pre class="json-example">"status": "string|enum:active,inactive"</pre>
    </div>

    <div class="explanation">
        <h3>Foreign Key Column:</h3>
        <pre class="json-example">"categoryId": "integer|foreign:categories:categoryId"</pre>
    </div>

    <div class="explanation">
        <h3>Timestamp Column:</h3>
        <pre class="json-example">"createdAt": "timestamp"</pre>
    </div>

    <div class="explanation">
        <h3>Nullable Column:</h3>
        <pre class="json-example">"productImage": "string|nullable"</pre>
    </div>

    <div class="explanation">
        <h3>Unique Column:</h3>
        <pre class="json-example">"email": "string|max:255|unique"</pre>
    </div>

    <div class="explanation">
        <h3>Column with Minimum and Maximum Value:</h3>
        <pre class="json-example">"stock": "integer|min:1|max:100"</pre>
    </div>

    <div class="explanation">
        <h3>Timestamp Column with Default Value:</h3>
        <pre class="json-example">"createdAt": "timestamp|nullable|default:CURRENT_TIMESTAMP"</pre>
    </div>

    <div class="explanation">
        <h3>Timestamp Column with on_update Rule:</h3>
        <pre class="json-example">"updatedAt": "timestamp|nullable|on_update"</pre>
    </div>
</div>

<!-- Link to Highlight.js JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
<script>
    // Initialize Highlight.js
    hljs.highlightAll();
</script>

</body>
</html>
