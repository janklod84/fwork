<!-- variables $id from class Menu -->
<li class="test">
    <a href="?id=<?=$id?>"><?= $category['title'] ?></a>
    <?php if(isset($category['childs'])): ?>
        <ul>
            <?= $this->getMenuHtml($category['childs']) ?>
        </ul>
    <?php endif; ?>
</li>

<!--
create une methode au sein de la classe Project\Widgets\Menu\Menu nommee getChilds():

public function getChilds()
{
  if(!empty($category['childs'])
  {
       echo '<surround>';
       return $category['childs'];
       echo '</surround>';
  }
}
-->