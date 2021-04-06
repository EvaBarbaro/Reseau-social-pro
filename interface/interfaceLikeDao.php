<?php

interface interfaceLikeDao{
    public function Like_Unlike($obj);
    public function Liked($obj) : bool;
}