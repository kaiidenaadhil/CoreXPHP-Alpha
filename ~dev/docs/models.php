<?php include_once "../components/docs-header.php"; ?><main class="content">
    <div class="breadcrumb"><a href="#">Docs</a> > <a href="#">Models</a></div>
    <h1>CoreXPHP Model Method Guide by Category</h1>
    <h2>CRUD</h2>
    <table border='1' cellpadding='8' cellspacing='0'>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Model Method</th>
                <th>Category</th>
                <th>Description</th>
                <th>Why Use It</th>
                <th>Example Usage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>findAll()</td>
                <td>CRUD</td>
                <td>Returns a QueryBuilder instance with filters, search, sort, pagination.</td>
                <td>For fetching filtered & paginated lists of records.</td>
                <td>LeadModel->findAll(['filters' => ['status' => 'new']])->get()</td>
            </tr>
            <tr>
                <td>2</td>
                <td>find($id)</td>
                <td>CRUD</td>
                <td>Fetches one record by primary key.</td>
                <td>Quick way to fetch one row using ID.</td>
                <td>LeadModel->find(5)</td>
            </tr>
            <tr>
                <td>3</td>
                <td>create(array \$data)</td>
                <td>CRUD</td>
                <td>Inserts a new row using QueryBuilder::insert().</td>
                <td>Adds new entries to database.</td>
                <td>LeadModel->create(['name' => 'John'])</td>
            </tr>
            <tr>
                <td>4</td>
                <td>update(array, id)</td>
                <td>CRUD</td>
                <td>Updates a row by ID using QueryBuilder::update().</td>
                <td>To change existing record's data.</td>
                <td>LeadModel->update(['status' => 'done'], 5)</td>
            </tr>
            <tr>
                <td>5</td>
                <td>delete(id)</td>
                <td>CRUD</td>
                <td>Deletes a row by ID using QueryBuilder::delete().</td>
                <td>Removes a specific row from database.</td>
                <td>LeadModel->delete(5)</td>
            </tr>
            <tr>
                <td>6</td>
                <td>truncate()</td>
                <td>CRUD</td>
                <td>Truncates the entire table.</td>
                <td>Removes all records from a table.</td>
                <td>LeadModel->truncate()</td>
            </tr>
            <tr>
                <td>7</td>
                <td>save()</td>
                <td>CRUD</td>
                <td>Insert or update depending on primary key presence.</td>
                <td>Handles both create and update logic.</td>
                <td>\$lead->status = 'won'; \$lead->save();</td>
            </tr>
        </tbody>
    </table><br>
    <h2>Selection</h2>
    <table border='1' cellpadding='8' cellspacing='0'>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Model Method</th>
                <th>Category</th>
                <th>Description</th>
                <th>Why Use It</th>
                <th>Example Usage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>8</td>
                <td>select()</td>
                <td>Selection</td>
                <td>Specifies columns to select.</td>
                <td>Customizes fields to retrieve.</td>
                <td>LeadModel->select(['id', 'name'])</td>
            </tr>
            <tr>
                <td>9</td>
                <td>selectRaw()</td>
                <td>Selection</td>
                <td>Sets raw SELECT clause.</td>
                <td>Use for expressions or aliases.</td>
                <td>LeadModel->selectRaw('COUNT(*) as total')</td>
            </tr>
            <tr>
                <td>10</td>
                <td>first()</td>
                <td>Selection</td>
                <td>Returns the first row from results.</td>
                <td>Efficiently fetch one record.</td>
                <td>LeadModel->where('status', 'new')->first()</td>
            </tr>
            <tr>
                <td>11</td>
                <td>get()</td>
                <td>Selection</td>
                <td>Fetches all rows from the query.</td>
                <td>For retrieving multiple rows.</td>
                <td>LeadModel->where('type', 'hot')->get()</td>
            </tr>
        </tbody>
    </table><br>
    <h2>Joins</h2>
    <table border='1' cellpadding='8' cellspacing='0'>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Model Method</th>
                <th>Category</th>
                <th>Description</th>
                <th>Why Use It</th>
                <th>Example Usage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>12</td>
                <td>join()</td>
                <td>Join</td>
                <td>Adds JOIN clause to query.</td>
                <td>To combine data across tables.</td>
                <td>LeadModel->join('users', 'leads.userId', '=', 'users.id')</td>
            </tr>
        </tbody>
    </table><br>
    <h2>Filters</h2>
    <table border='1' cellpadding='8' cellspacing='0'>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Model Method</th>
                <th>Category</th>
                <th>Description</th>
                <th>Why Use It</th>
                <th>Example Usage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>13</td>
                <td>where()</td>
                <td>Filter</td>
                <td>Adds WHERE condition.</td>
                <td>Basic filtering.</td>
                <td>LeadModel->where('status', 'active')</td>
            </tr>
            <tr>
                <td>14</td>
                <td>orWhere()</td>
                <td>Filter</td>
                <td>Adds OR WHERE condition.</td>
                <td>Alternate filtering option.</td>
                <td>LeadModel->orWhere('status', 'pending')</td>
            </tr>
            <tr>
                <td>15</td>
                <td>whereIn()</td>
                <td>Filter</td>
                <td>WHERE IN condition.</td>
                <td>Check if column matches any in list.</td>
                <td>LeadModel->whereIn('status', ['open', 'closed'])</td>
            </tr>
            <tr>
                <td>16</td>
                <td>whereNotIn()</td>
                <td>Filter</td>
                <td>WHERE NOT IN condition.</td>
                <td>Exclude matches from a list.</td>
                <td>LeadModel->whereNotIn('status', ['spam'])</td>
            </tr>
            <tr>
                <td>17</td>
                <td>whereBetween()</td>
                <td>Filter</td>
                <td>WHERE BETWEEN condition.</td>
                <td>Filter within range.</td>
                <td>LeadModel->whereBetween('score', [50, 100])</td>
            </tr>
            <tr>
                <td>18</td>
                <td>whereNotBetween()</td>
                <td>Filter</td>
                <td>WHERE NOT BETWEEN condition.</td>
                <td>Filter outside of range.</td>
                <td>LeadModel->whereNotBetween('score', [50, 100])</td>
            </tr>
            <tr>
                <td>19</td>
                <td>whereNull()</td>
                <td>Filter</td>
                <td>WHERE IS NULL condition.</td>
                <td>Find rows with nulls.</td>
                <td>LeadModel->whereNull('email')</td>
            </tr>
            <tr>
                <td>20</td>
                <td>whereNotNull()</td>
                <td>Filter</td>
                <td>WHERE IS NOT NULL condition.</td>
                <td>Find rows with values.</td>
                <td>LeadModel->whereNotNull('email')</td>
            </tr>
            <tr>
                <td>21</td>
                <td>whereRaw()</td>
                <td>Filter</td>
                <td>Raw WHERE clause.</td>
                <td>Advanced manual conditions.</td>
                <td>LeadModel->whereRaw('score > 50 AND active = 1')</td>
            </tr>
            <tr>
                <td>22</td>
                <td>filter(array)</td>
                <td>Filter</td>
                <td>Applies dynamic filters.</td>
                <td>Quickly build dynamic filters.</td>
                <td>LeadModel->filter(['status' => 'open'])</td>
            </tr>
            <tr>
                <td>23</td>
                <td>search(term, columns)</td>
                <td>Filter</td>
                <td>OR LIKE conditions for searching.</td>
                <td>Free-text searching.</td>
                <td>LeadModel->search('john', ['name', 'email'])</td>
            </tr>
        </tbody>
    </table><br>
    <h2>Grouping</h2>
    <table border='1' cellpadding='8' cellspacing='0'>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Model Method</th>
                <th>Category</th>
                <th>Description</th>
                <th>Why Use It</th>
                <th>Example Usage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>24</td>
                <td>groupBy()</td>
                <td>Group</td>
                <td>GROUP BY clause.</td>
                <td>Aggregate by column(s).</td>
                <td>LeadModel->groupBy(['status'])</td>
            </tr>
            <tr>
                <td>25</td>
                <td>having()</td>
                <td>Group</td>
                <td>HAVING clause.</td>
                <td>Filter groups after aggregation.</td>
                <td>LeadModel->groupBy('status')->having('count(*)', '>', 5)</td>
            </tr>
        </tbody>
    </table><br>
    <h2>Pagination</h2>
    <table border='1' cellpadding='8' cellspacing='0'>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Model Method</th>
                <th>Category</th>
                <th>Description</th>
                <th>Why Use It</th>
                <th>Example Usage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>26</td>
                <td>limit()</td>
                <td>Pagination</td>
                <td>Limits rows returned.</td>
                <td>Control number of rows fetched.</td>
                <td>LeadModel->limit(5)</td>
            </tr>
            <tr>
                <td>27</td>
                <td>offset()</td>
                <td>Pagination</td>
                <td>Skips number of rows.</td>
                <td>Offset for pagination.</td>
                <td>LeadModel->offset(10)</td>
            </tr>
            <tr>
                <td>28</td>
                <td>paginate()</td>
                <td>Pagination</td>
                <td>Handles full pagination + meta.</td>
                <td>Paginate results with metadata.</td>
                <td>LeadModel->paginate(1, 10)</td>
            </tr>
        </tbody>
    </table><br>
    <h2>Aggregation</h2>
    <table border='1' cellpadding='8' cellspacing='0'>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Model Method</th>
                <th>Category</th>
                <th>Description</th>
                <th>Why Use It</th>
                <th>Example Usage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>29</td>
                <td>count()</td>
                <td>Aggregate</td>
                <td>Counts rows.</td>
                <td>Get total number of records.</td>
                <td>LeadModel->count()</td>
            </tr>
            <tr>
                <td>30</td>
                <td>sum()</td>
                <td>Aggregate</td>
                <td>SUM of a column.</td>
                <td>Add values of a column.</td>
                <td>LeadModel->sum('amount')</td>
            </tr>
            <tr>
                <td>31</td>
                <td>avg()</td>
                <td>Aggregate</td>
                <td>Average of a column.</td>
                <td>Get mean value.</td>
                <td>LeadModel->avg('rating')</td>
            </tr>
            <tr>
                <td>32</td>
                <td>min()</td>
                <td>Aggregate</td>
                <td>Minimum value.</td>
                <td>Get lowest value.</td>
                <td>LeadModel->min('score')</td>
            </tr>
            <tr>
                <td>33</td>
                <td>max()</td>
                <td>Aggregate</td>
                <td>Maximum value.</td>
                <td>Get highest value.</td>
                <td>LeadModel->max('score')</td>
            </tr>
        </tbody>
    </table><br>
    <h2>Debugging</h2>
    <table border='1' cellpadding='8' cellspacing='0'>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Model Method</th>
                <th>Category</th>
                <th>Description</th>
                <th>Why Use It</th>
                <th>Example Usage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>34</td>
                <td>toSql()</td>
                <td>Debugging</td>
                <td>Returns generated SQL.</td>
                <td>Useful for debugging queries.</td>
                <td>LeadModel->where('id', 1)->toSql()</td>
            </tr>
            <tr>
                <td>35</td>
                <td>logQuery()</td>
                <td>Debugging</td>
                <td>Logs query to file.</td>
                <td>Debug query logs.</td>
                <td>LeadModel->logQuery()</td>
            </tr>
        </tbody>
    </table><br>

    <div class="pagination"><a href="<?= ROOT ?>/docs/controllers.php" class="prev-page">Previous Page</a>
    <a href="<?= ROOT ?>/docs/views.php" class="next-page">Next Page</a></div>
</main><?php include_once "../components/docs-footer.php"; ?>