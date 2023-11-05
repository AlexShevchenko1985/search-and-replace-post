<div class="wrap">
    <h2><?php echo __('Search and replace post', 'src'); ?></h2>
    <form id="search-form">
        <input type="text" id="search-input" placeholder="keyword..." required>
        <input type="submit" value="Search">
    </form>
    <div id="search-results"></div>
</div>

<table class="admin-table wp-list-table widefat fixed striped table-view-list pages">
    <tr>
        <td>
            <h4><?php echo __('Title', 'srp'); ?></h4>
            <form id="search-title">
                <input type="text" id="input-search-title" placeholder="keyword...">
                <input type="submit" value="Search">
            </form>
        </td>
        <td>
            <h4><?php echo __('Content', 'srp'); ?></h4>
            <form id="search-content">
                <input type="text" id="input-search-content" placeholder="keyword...">
                <input type="submit" value="Search">
            </form>
        </td>
        <td>
            <h4><?php echo __('Meta-title', 'srp'); ?></h4>
            <form id="search-meta-title">
                <input type="text" id="input-search-meta-title" placeholder="keyword...">
                <input type="submit" value="Search">
            </form>
        </td>
        <td>
            <h4><?php echo __('Meta-description', 'srp'); ?></h4>
            <form id="search-meta-description">
                <input type="text" id="input-search-meta-description" placeholder="keyword...">
                <input type="submit" value="Search">
            </form>
        </td>
    </tr>
    <tbody id="search-tbody" data-ids="">
    </tbody>
</table>
