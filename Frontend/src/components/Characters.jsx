import React, { useEffect, useState, } from 'react';
import axios from 'axios';
import { Outlet, Link } from "react-router-dom";


const Characters = () => {

    const [data, setData] = useState([]);

    useEffect(() => 
    async function getUser(){

        try {
            const response = await axios.get('http://localhost:8787/characters/');
            const idk = await response.data;

            setData(idk);
        } catch (error){
            console.log(error);
        }
    }, [])

    return (
        <>
            <section className="container">
            <div className="muse-wrapper"><h2>Characters</h2>
            <table><thead>
                <tr><th>Name</th><th>Age</th><th>Gender</th></tr></thead>
                <tbody>
                    {
                    data.map((a, index) => <tr key={index}>
                    <td><Link to={`/characters/${a.id}`}>{a.nom} {a.prenom}</Link></td>
                    <td>{a.age}</td>
                    <td>{a.gender}</td>
                    </tr>)
                    }  
                </tbody>    
            </table>
            </div>
            <div className="muse-display">
        <Outlet />
        </div>
        </section>
        </>
    );
};

export default Characters;