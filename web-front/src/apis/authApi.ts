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
    const res: AuthResponseType = {
      success: true,
      data: {
        token: data.data.token,
        user: data.data.user,
      },
      message: data.message,
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

/**
 * 会員登録API
 * @param name 名前
 * @param email メールアドレス
 * @param password パスワード
 * @param password_confirmation パスワード確認
 * @returns 会員登録成功時はトークン、失敗時はエラーメッセージ
 */
export const signUpApi = async (name: string, email: string, password: string, password_confirmation: string) => {
  try {
    const { data }: AxiosResponse<AuthResponseType> = await globalAxios.post('/register', {
      name,
      email,
      password,
      password_confirmation,
    });
    const res: AuthResponseType = {
      success: true,
      data: {
        token: data.data.token,
        user: data.data.user,
      },
      message: data.message,
    };
    return res;
  } catch (error) {
    const res: ResponseType = {
      success: false,
      message: '会員登録に失敗しました',
    };
    if (isAxiosError(error)) {
      const axiosError = error as IErrorResponse;
      res.message = axiosError.response?.data.message;
    }
    return res;
  }
};
