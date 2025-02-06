/**
 * SignInPage
 *
 * @package pages
 */
import type { NextPage } from 'next';
import { useEffect, useState } from 'react';

interface ApiResponseItem {
  message: string;
  data: {
    name: string;
  };
}

/**
 * SignInPage
 * @constructor
 */
const SignInPage: NextPage = () => {
  const [data, setData] = useState([]);

  useEffect(() => {
    fetch('http://localhost/api/users')
      .then((response) => response.json())
      .then((data: ApiResponseItem[]) => setData(data))
      .catch((error) => console.error('Error fetching data:', error));
  }, []);

  return (
    <div>
      <h1>ユーザー一覧</h1>
      <p>{data.message}</p>
      <p>{data.data.name}</p>
    </div>
  );
};

export default SignInPage;
