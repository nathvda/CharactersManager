import React from "react";
import { Outlet, Link } from "react-router-dom";

const Home = () => {

    return (
<>
    <Link to={'/'}><h1>Muse manager.</h1></Link>
    <div className="mainpara">You'll find here the list of the muses you might need.</div>
    <nav><Link to={`/characters`}>Muses</Link>
    <Link to={`/threads`}>Threads</Link>
    <Link to={`/newcharacter`}>Add muse</Link>
    <Link to={`/newthread`}>Add thread</Link></nav>
    <Outlet />
</>

    );

};

export default Home;