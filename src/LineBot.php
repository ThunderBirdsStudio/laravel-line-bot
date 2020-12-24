<?php

namespace Tbs\LineBot;

class LineBot extends Connection
{
    use Login, Message, OAuth, Profile, RichMenu;
}
