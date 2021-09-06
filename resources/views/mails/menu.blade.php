Dobrý den,<br/>
zasílám polední menu na tento týden - {{ $menu->caption }}<br/>
<br/>
@if($menu->restaurant == 2)
za Zámeckou restauraci Dobříš<br/>
@elseif($menu->restaurant == 1)
za Restauraci Modrá Kočka<br/>
@else
za restauraci Modrá Kočka {{ $restaurant->name }}<br/>
@endif
Roman Malý<br/>


