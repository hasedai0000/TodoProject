import { AxiosResponse } from 'axios';
import globalAxios, { isAxiosError, ResponseType, IErrorResponse } from '@/apis/config';
import { AuthResponseType } from '@/interfaces/User';

/**
 * ログイン
 * @param email メールアドレス
 * @param password パスワード
 * @returns ログイン成功時はトークン、失敗時はエラーメッセージ
 */
export const signInApi = async (email: string, password: string) => {
  try {
    const { data }: AxiosResponse<AuthResponseType> = await globalAxios.post('/login', { email, password });
    const res: ResponseType<AuthResponseType> = {
      success: true,
      data: data,
    };
    return res;
  } catch (error) {
    const res: ResponseType = {
      success: false,
      message: 'ログインに失敗しました',
    };
    if (isAxiosError(error)) {
      const axiosError = error as IErrorResponse;
      res.message = axiosError.response?.data.message;
    }
    return res;
  }
};
