${alias} <br>
${plus "value" alias} <br>
${concatArr (key: "value", key2: List.items.item, key3: "value3")} <br>
${concat arg1 "string"} <br>
${List.items.item} <br>

#{template.tpl List.items.item} <br>
*{newItem.tpl List.items2} <br>
*{newItem.tpl List.items List.items2 (key: "value", key2: alias)} <br>