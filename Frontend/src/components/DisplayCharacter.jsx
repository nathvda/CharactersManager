import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useParams } from 'react-router-dom';

const DisplayCharacter = () => {
    const { id } = useParams(); 
    const [data, setData] = useState([]);

    console.log("composant monté");

    useEffect( () =>     

    async function getMuse() {

    console.log("function launched");

        try {

            console.log("fetching data");

    const res = await axios.get(`http://localhost:8787/characters/${id}`);
    const idk = await res.data;

    setData(idk);
    console.log(idk);
    
        }
        catch (error){
            console.log(error);
        }

        console.log("end of function");
    
}, [id]);

    return (
        <>
        <div className="profile">
        {id}
        {
            data.map((a) => 
            a.nom
            )
        }</div> 
        {console.log('unmounting')}
        </>
        
    );
};

export default DisplayCharacter;